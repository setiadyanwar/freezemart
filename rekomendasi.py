from flask import Flask, request, jsonify
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity
from nltk.corpus import stopwords
import nltk

# Pastikan stopwords sudah tersedia
try:
    stopwords_indonesia = stopwords.words('indonesian')
except LookupError:
    nltk.download('stopwords')
    stopwords_indonesia = stopwords.words('indonesian')

app = Flask(__name__)

@app.route('/recommend', methods=['GET', 'POST'], strict_slashes=False)
def recommend():
    data = request.json

    deskripsi_produk = data.get('produk', [])
    input_teks = data.get('input_teks', '').strip()
    harga_maks = data.get('harga_maks', float('inf'))
    user_profile = data.get('user_profile', '').strip()

    # Tentukan input final untuk vektorisasi
    if input_teks:
        final_input = input_teks
    elif user_profile:
        final_input = user_profile
    else:
        return jsonify([])

    # Buat corpus berdasarkan deskripsi produk + input pengguna
    corpus = [p['description'] for p in deskripsi_produk] + [final_input]

    # Vektorisasi dengan stopwords Bahasa Indonesia
    vectorizer = TfidfVectorizer(stop_words=stopwords_indonesia)
    tfidf_matrix = vectorizer.fit_transform(corpus)

    produk_vectors = tfidf_matrix[:-1]  # Vektor semua produk
    input_vector = tfidf_matrix[-1]     # Vektor input user

    # Hitung cosine similarity
    similarities = cosine_similarity(produk_vectors, input_vector).flatten()

    hasil = []
    for i, p in enumerate(deskripsi_produk):
        similarity_score = float(similarities[i])
        if similarity_score > 0 and p['price'] <= harga_maks:
            hasil.append({
                'id': p['id'],
                'name': p['name'],
                'price': p['price'],
                'description': p['description'],
                'similarity': round(similarity_score, 3),
                'image': p.get('image')
            })

    # Urutkan berdasarkan kemiripan tertinggi
    hasil_sorted = sorted(hasil, key=lambda x: x['similarity'], reverse=True)

    return jsonify(hasil_sorted)

if __name__ == '__main__':
    # Ganti port & debug saat development saja
    app.run(debug=True, port=5001)
