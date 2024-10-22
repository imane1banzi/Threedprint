<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3D Printing Service - Upload Your Model</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/examples/js/loaders/STLLoader.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <style>
        /* Global styles */
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: white;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        h1, h2, h3 {
            color: #444;
            margin-bottom: 20px;
        }

        .section {
            margin-bottom: 50px;
        }

        /* File Upload Section */
        .file-upload {
            background-color: #e0e0e0;
            padding: 40px;
            border-radius: 10px;
            border: 2px dashed #aaa;
            text-align: center;
            margin-bottom: 30px;
            position: relative;
        }

        .file-upload input[type="file"] {
            display: none;
        }

        .file-upload label {
            display: block;
            font-size: 18px;
            color: #666;
            cursor: pointer;
        }

        .file-info {
            margin-top: 10px;
            font-weight: 500;
        }

        .upload-button {
            background-color: #007bff;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }

        /* 3D Visualization styles */
        #3d-container {
            width: 600px; 
            height: 400px; 
            background-color: #e0e0e0; 
            margin-right: 20px; 
            display: none; /* Hide by default */
        }

        .controls {
            display: flex;
            justify-content: center; 
            margin-top: 10px; 
        }

        button {
            padding: 10px;
            background-color: #007bff; 
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px; 
            font-size: 14px;
        }

        button:hover {
            background-color: #0056b3; 
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header Section -->
        <div class="section">
            <h1><i class="fas fa-print"></i> Professional 3D Printing Service</h1>
            <p>Upload your 3D model to get started with high-quality 3D printing. We support STL and OBJ formats.</p>
        </div>

        <!-- File Upload Section -->
        <div class="section">
            <h2><i class="fas fa-file-upload"></i> Upload Your 3D File</h2>
            <form action="/print3d/upload" method="post" enctype="multipart/form-data">
                <div class="file-upload">
                    <label for="file"><i class="fas fa-upload"></i> Click here to upload your file (STL or OBJ)</label>
                    <input type="file" id="file" name="file" accept=".stl,.obj" onchange="displayFileName()">
                    <p class="file-info" id="file-info">No file selected yet</p>
                    <button type="submit" class="upload-button"><i class="fas fa-paper-plane"></i> Send to Printer</button>
                </div>
            </form>
            <button id="show-3d" class="upload-button"><i class="fas fa-eye"></i> Show 3D Visualization</button>
        </div>

        <!-- 3D Visualization Section -->
        <h1><i class="fas fa-cube icon"></i> 3D Visualization</h1>
        <div class="section">
            <div id="3d-container"></div>
            <div class="controls">
                <button id="view-front"><i class="bi bi-eye"></i> Front View</button>
                <button id="view-object"><i class="bi bi-eye-fill"></i> Object View</button>
                <button id="zoom-in"><i class="bi bi-zoom-in"></i> Zoom In</button>
                <button id="zoom-out"><i class="bi bi-zoom-out"></i> Zoom Out</button>
                <button id="restart-animation"><i class="bi bi-arrow-clockwise"></i> Restart Animation</button>
            </div>
        </div>
    </div>

    <script>
        var isAnimating = true; // Flag to control animation state
        var uploadedFileUrl; // Variable to hold the uploaded file URL
        var scene, camera, renderer; // Declare variables for 3D scene components

        window.onload = function() {
            // Initialize the scene, camera, and renderer
            scene = new THREE.Scene();
            camera = new THREE.PerspectiveCamera(75, 600 / 400, 0.1, 1000);
            renderer = new THREE.WebGLRenderer({ alpha: true });
            renderer.setSize(600, 400);
            document.getElementById('3d-container').appendChild(renderer.domElement);
            camera.position.set(0, 2, 5); // Adjust the camera position

            // Animation function
            function animate() {
                if (isAnimating) {
                    scene.children.forEach(child => {
                        if (child instanceof THREE.Mesh) {
                            child.rotation.y += 0.01; // Rotate the mesh continuously
                        }
                    });
                }
                renderer.render(scene, camera);
                requestAnimationFrame(animate);
            }
            animate();

            // Restart the animation
            document.getElementById('restart-animation').addEventListener('click', function() {
                isAnimating = true; // Set flag to true to restart animation
                scene.children.forEach(child => {
                    if (child instanceof THREE.Mesh) {
                        child.rotation.y = 0; // Reset rotation to initial position
                    }
                });
            });

            // Handle buttons to change the view
            document.getElementById('view-front').addEventListener('click', function() {
                camera.position.set(0, 2, 5); // Front view
                camera.lookAt(0, 0, 0);
            });

            document.getElementById('view-object').addEventListener('click', function() {
                camera.position.set(3, 3, 3); // Oblique view of the object
                camera.lookAt(0, 0, 0);
            });

            // Handle zoom buttons
            document.getElementById('zoom-in').addEventListener('click', function() {
                camera.position.z -= 1; // Move camera closer
            });

            document.getElementById('zoom-out').addEventListener('click', function() {
                camera.position.z += 1; // Move camera further away
            });

            // Show 3D visualization on button click
            document.getElementById('show-3d').addEventListener('click', function() {
                if (uploadedFileUrl) {
                    loadSTL(); // Load the STL file if available
                    document.getElementById('3d-container').style.display = 'block'; // Show the 3D container
                } else {
                    alert('Please upload a file first!'); // Alert if no file is uploaded
                }
            });
        };

        // Function to display the uploaded file name and set the file URL
        function displayFileName() {
            var fileInput = document.getElementById('file');
            var fileInfo = document.getElementById('file-info');
            
            if (fileInput.files.length > 0) {
                var file = fileInput.files[0];
                fileInfo.innerHTML = 'Uploaded File: ' + file.name; // Display file name
                uploadedFileUrl = URL.createObjectURL(file); // Create a URL for the uploaded file
            } else {
                fileInfo.innerHTML = 'No file selected yet'; // Reset display text
                uploadedFileUrl = null; // Reset the uploaded file URL
            }
        }

        // Function to load the STL file
        function loadSTL() {
            var loader = new THREE.STLLoader(); // Create an STLLoader instance
            loader.load(uploadedFileUrl, function (geometry) {
                var material = new THREE.MeshStandardMaterial({ color: 0x0077ff }); // Material for the mesh
                var mesh = new THREE.Mesh(geometry, material); // Create a mesh with the loaded geometry
                scene.add(mesh); // Add mesh to the scene
                mesh.position.set(0, 0, 0); // Position the mesh in the center
                isAnimating = false; // Stop animation when a model is loaded
            });
        }
    </script>
</body>
</html>
