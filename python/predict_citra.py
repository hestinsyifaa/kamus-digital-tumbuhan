from ultralytics import YOLO
import sys
import json

# ambil argumen
model_path = sys.argv[1]
img_path = sys.argv[2]

# load model
model = YOLO(model_path)

# predict
results = model.predict(
    source=img_path,
    conf=0.25,
    verbose=False
)

result = results[0]

# cek ada objek atau tidak
if result.boxes is not None and len(result.boxes) > 0:

    # ambil confidence tertinggi
    confs = result.boxes.conf.cpu().numpy()
    best_index = confs.argmax()

    # ambil class terbaik
    class_id = int(result.boxes.cls[best_index])

    # nama class
    hasil = result.names[class_id]

    confidence = float(confs[best_index])

else:
    hasil = "Tidak terdeteksi"
    confidence = 0

# print("JUMLAH BOX:", len(result.boxes))

# kirim hasil ke laravel
print(json.dumps({
    "hasil": hasil,
    "confidence": round(confidence, 2)
}))