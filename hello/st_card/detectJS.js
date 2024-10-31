function uploadPicture() {
    const fileInput = document.getElementById('fileInput');
    const file = fileInput.files[0];
    const formData = new FormData();
    formData.append('picture', file);

    fetch('http://127.0.0.1:5000/api/picture', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        console.log(response)
        return response.json();
    })
    .then(data => {
        console.log('Picture uploaded successfully:', data.message);
    })
    .catch(error => {
        console.error('Error uploading picture:', error);
    });
}