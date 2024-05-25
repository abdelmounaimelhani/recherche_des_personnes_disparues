from flask import Flask, request, jsonify
import cv2
import face_recognition
import glob
import os

app = Flask(__name__)

@app.route('/', methods=['GET'])
def compare_faces():
    folder_dir = 'D:/ABELMOUNAIM/App/XAMPP/htdocs/Project/Python/images'
    reference_image_path = "D:/ABELMOUNAIM/App/XAMPP/htdocs/Project/Python/images/IMG_20231006_131000.jpg"

    # Check if the reference image exists
    if not os.path.exists(reference_image_path):
        return jsonify({'error': 'Reference image not found'}), 404

    # Load and process the reference image
    image1 = cv2.imread(reference_image_path)
    if image1 is None:
        return jsonify({'error': 'Failed to read the reference image'}), 500

    rgbimage1 = cv2.cvtColor(image1, cv2.COLOR_BGR2RGB)
    img_encoding1 = face_recognition.face_encodings(rgbimage1)
    if not img_encoding1:
        return jsonify({'error': 'No faces found in the reference image'}), 400

    img_encoding1 = img_encoding1[0]

    similar_images = []

    for image_path in glob.iglob(f'{folder_dir}/*'):
        if image_path.lower().endswith(('.png', '.jpg', '.jpeg')):
            image2 = cv2.imread(image_path)
            if image2 is None:
                continue  # Skip files that couldn't be read

            rgbimage2 = cv2.cvtColor(image2, cv2.COLOR_BGR2RGB)
            img_encoding2 = face_recognition.face_encodings(rgbimage2)
            if not img_encoding2:
                continue  # Skip images where no faces are found

            img_encoding2 = img_encoding2[0]

            # Compare face encodings and calculate the similarity score
            similarity_score = face_recognition.face_distance([img_encoding1], img_encoding2)[0]

            # Check if the similarity score is less than or equal to 0.6 (60% similarity)
            if similarity_score <= 0.6:
                similar_images.append({'image_path': image_path, 'similarity_score': similarity_score})

    return jsonify({'similar_images': similar_images})

if __name__ == '__main__':
    app.run(debug=True)
