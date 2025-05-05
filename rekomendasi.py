from flask import Flask, request, jsonify
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity

app = Flask(__name__)

@app.route('/recommend', methods=['GET', 'POST'], strict_slashes=False)
def recommend():
    data = request.json
    deskripsi_produk = data['produk']
    input_teks = data['input_teks'].strip()
    harga_maks = data['harga_maks']
    user_profile = data.get('user_profile', '').strip()

    # Tentukan input final untuk vektorisasi
    if input_teks:
        # User sedang mengetik sesuatu → pakai input user saja
        final_input = input_teks
    elif user_profile:
        # User tidak ketik apa-apa → pakai histori user
        final_input = user_profile
    else:
        # Tidak ada input sama sekali
        return jsonify([])

    # Buat corpus berdasarkan deskripsi produk
    corpus = [p['description'] for p in deskripsi_produk] + [final_input]

    # TF-IDF vectorization
    vectorizer = TfidfVectorizer()
    tfidf_matrix = vectorizer.fit_transform(corpus)

    produk_vectors = tfidf_matrix[:-1]
    input_vector = tfidf_matrix[-1]

    # Hitung similarity
    similarities = cosine_similarity(produk_vectors, input_vector).flatten()

    # Filter produk yang relevan
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
                'image': p.get('image'),
            })

    # Urutkan berdasarkan kemiripan tertinggi
    hasil_sorted = sorted(hasil, key=lambda x: x['similarity'], reverse=True)
    return jsonify(hasil_sorted)

if __name__ == '__main__':
    app.run(debug=True, port=5001)
