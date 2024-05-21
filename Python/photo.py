import cv2
import face_recognition
import glob

folder_dir = 'images'

image1 = cv2.imread("images/cristiano ronaldo 1.jpg")
rgbimage1 = cv2.cvtColor(image1, cv2.COLOR_BGR2RGB)
img_encoding1 = face_recognition.face_encodings(rgbimage1)[0]

similar_images = []

for image_path in glob.iglob(f'{folder_dir}/*'):
    if (image_path.endswith(".png") or image_path.endswith(".jpg") or image_path.endswith(".jpeg")):
        image2 = cv2.imread(image_path)
        rgbimage2 = cv2.cvtColor(image2, cv2.COLOR_BGR2RGB)
        img_encoding2 = face_recognition.face_encodings(rgbimage2)[0]
        
        # Compare face encodings and calculate the similarity score
        similarity_score = face_recognition.face_distance([img_encoding1], img_encoding2)[0]
        
        # Check if the similarity score is less than or equal to 0.3 (30% similarity)
        if similarity_score <= 0.6:
            similar_images.append(image_path)
            print(f"Similarity Score: {similarity_score}, Image: {image_path}")

print("Similar Images:")
for image_path in similar_images:
    print(image_path)
