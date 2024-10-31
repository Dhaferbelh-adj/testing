from flask import Flask, request
import cv2
from flask_cors import CORS
import numpy as np
from ultralytics import YOLO


app = Flask(__name__)
cors = CORS(app)
model = YOLO("best(1).pt")
@app.route('/api/picture', methods=['POST','GET'])
def picture():
    image = request.files['picture']
    image = cv2.imread(image)
    image = cv2.resize(image, (640 , 640))
 
    results = model(image)
    detections = 0
    for result in results:
        for box in result.boxes:
            detections=detections+1  
    print(f"aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa {detections}")  # Convert the annotated image to a format suitable for sending as a response
    if detections >0:
        return {'message':  "yes"}
    return {'message':  "no"}
    

if __name__ == '__main__':
    app.run(debug=True,port=5000)