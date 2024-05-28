from flask import Flask, request, jsonify
import cv2
import face_recognition
import os
import pymysql
from flask_cors import CORS, cross_origin
import logging

app = Flask(__name__)
CORS(app)

logging.basicConfig(level=logging.DEBUG)

def compare_faces(reference_path, image_paths):
    reference_image_path = 'D:/ABELMOUNAIM/App/XAMPP/htdocs/Project/' + reference_path

    if not os.path.exists(reference_image_path):
        return jsonify({'error': 'Reference image not found'}), 404

    try:
        image1 = cv2.imread(reference_image_path)
        if image1 is None:
            return jsonify({'error': 'Failed to read the reference image'}), 500

        rgbimage1 = cv2.cvtColor(image1, cv2.COLOR_BGR2RGB)
        img_encodings1 = face_recognition.face_encodings(rgbimage1)
        if not img_encodings1:
            return jsonify({'error': 'No faces found in the reference image'}), 400

        similar_images = []

        for image_path in image_paths:
            full_image_path = "D:/ABELMOUNAIM/App/XAMPP/htdocs/Project/" + image_path[1]
            if full_image_path.lower().endswith(('.png', '.jpg', '.jpeg')):
                image2 = cv2.imread(full_image_path)
                if image2 is None:
                    continue
                rgbimage2 = cv2.cvtColor(image2, cv2.COLOR_BGR2RGB)
                img_encodings2 = face_recognition.face_encodings(rgbimage2)
                if not img_encodings2:
                    continue
                for encoding1 in img_encodings1:
                    for encoding2 in img_encodings2:
                        similarity_score = face_recognition.face_distance([encoding1], encoding2)[0]
                        if similarity_score <= 0.6:
                            similar_images.append(image_path[0])
                            break
        return jsonify(similar_images)
    except Exception as e:
        return jsonify({'error': str(e)}), 500

def Select_function(SelectR):
    try:
        idindiv = request.json.get("id")
        hash = request.json.get("hash")
        Date_D = request.json.get("date")

        connection = pymysql.connect(host='localhost', database='project', user='root', password='123456789')

        with connection.cursor() as cursor:
            select_query = "SELECT * FROM disparu WHERE id = %s AND HASH = %s"
            cursor.execute(select_query, (idindiv, hash))
            records = cursor.fetchall()

        with connection.cursor() as cursor1:
            select_query1 = SelectR
            cursor1.execute(select_query1, (Date_D))
            Diss = cursor1.fetchall()

        connection.close()
 
        if not records:
            return jsonify({'error': 'No records found for the given ID and hash'}), 404
        if not Diss:
            return jsonify({'error': 'No matching records found after the given date'}), 404

        reference_image_path = records[0][7] if len(records[0]) > 7 else None
        if not reference_image_path:
            return jsonify({'error': 'Reference image path is missing'}), 400

        return compare_faces(reference_image_path, Diss)
    except Exception as e:
        logging.error(f"An error occurred: {e}")
        return jsonify({"error": str(e)})

@app.route('/GetDisp', methods=['POST'])
@cross_origin()
def GetDisp():
    return Select_function("SELECT id, photo FROM disparu WHERE date_entre >= %s AND `type` = 'IND'")

@app.route('/GetIndi', methods=['POST'])
@cross_origin()
def GetIndi():
    return Select_function("SELECT id, photo FROM disparu WHERE date_disparition <= %s AND `type` = 'DIS'")

if __name__ == '__main__':
    app.run(debug=True)
