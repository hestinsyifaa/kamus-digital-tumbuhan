import sys
import json
import joblib
import os
import warnings

warnings.filterwarnings("ignore")

try:
    # ======================
    # INPUT TEXT
    # ======================
    if len(sys.argv) < 2:
        print(json.dumps({"error": "Teks input tidak ditemukan"}))
        sys.exit()

    text = sys.argv[1]

    if not text or text.strip() == "":
        print(json.dumps({"error": "Teks kosong"}))
        sys.exit()

    # ======================
    # NORMALISASI TEXT
    # ======================
    text = text.lower()
    text = text.replace("daunnya", "daun")
    text = text.replace("akarnya", "akar")
    text = text.replace("dan", " ")
    text = " ".join(text.split())

    # ======================
    # PATH MODEL + VECTORIZER
    # ======================
    BASE_DIR = os.path.dirname(os.path.abspath(__file__))

    model_path = os.path.join(BASE_DIR, "model_mnb.pkl")
    vectorizer_path = os.path.join(BASE_DIR, "vectorizer.pkl")

    # ======================
    # CEK FILE
    # ======================
    if not os.path.exists(model_path):
        print(json.dumps({"error": "Model tidak ditemukan"}))
        sys.exit()

    if not os.path.exists(vectorizer_path):
        print(json.dumps({"error": "Vectorizer tidak ditemukan"}))
        sys.exit()

    # ======================
    # LOAD MODEL
    # ======================
    model = joblib.load(model_path)
    vectorizer = joblib.load(vectorizer_path)

    # ======================
    # TRANSFORM TEXT
    # ======================
    X = vectorizer.transform([text])

    # ======================
    # PREDIKSI
    # ======================
    prediksi = model.predict(X)[0]
    prob = model.predict_proba(X).max(axis=1)[0]

    # ======================
    # FIX LABEL OUTPUT (STRING SAFE)
    # ======================
    prediksi = str(prediksi).lower()

    if prediksi == "dikotil":
        hasil = "Dikotil"
    else:
        hasil = "Monokotil"

    # ======================
    # OUTPUT JSON
    # ======================
    print(json.dumps({
        "hasil": hasil,
        "confidence": float(prob)
    }))

except Exception as e:
    print(json.dumps({
        "error": str(e)
    }))