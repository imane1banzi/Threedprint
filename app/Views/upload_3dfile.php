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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <style>
        /* Global styles */
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: white; /* Suppression du fond gris */
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

        p {
            font-size: 16px;
            line-height: 1.6;
            color: #666;
            margin-bottom: 20px;
        }

        .section {
            margin-bottom: 50px;
        }

        .sectionn {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .text-content {
            max-width: 60%; /* Adjust text content width */
        }

        .image-content img {
            max-width: 100%; /* Ensure image doesn't overflow */
            height: auto; /* Maintain image aspect ratio */
        }

        /* Style for icons */
        .fas {
            color: #007bff; /* Couleur bleue Nodematic pour les icônes */
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

        .file-upload:hover {
            border-color: #666;
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
            background-color: #007bff; /* Bouton bleu Nodematic */
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }

        .upload-button:hover {
            background-color: #0056b3; /* Couleur bleu foncé au survol */
        }

        /* Button styles */
        .button {
            background-color: #007bff; /* Bouton bleu Nodematic */
            color: white;
            padding: 15px 30px;
            border-radius: 5px;
            font-size: 18px;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #0056b3;
        }

        /* Info Boxes */
        .info-box {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            background-color: #ddd;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 40px;
        }

        .info-box img {
            max-width: 120px;
            margin-right: 30px;
        }

        .info-box-content {
            max-width: 70%;
        }

        /* Pricing table */
        .pricing-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            border: 1px solid #ccc;
        }

        .pricing-table th, .pricing-table td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ccc;
        }

        .pricing-table th {
            background-color: #555;
            color: white;
        }

        /* Footer Link */
        .back-link {
            margin-top: 30px;
            display: inline-block;
            text-decoration: none;
            color: #007bff;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        /* 3D Visualization styles */
       
        #3d-container {
            position: relative;
            width: 600px; /* Fixed width for the 3D container */
            height: 400px; /* Fixed height for the 3D container */
            background-color: #e0e0e0; /* Background color */
            overflow: hidden; /* Hide overflow */
            margin-right: 20px; /* Space between the 3D container and buttons */
        }

        .controls {
            display: flex;
            gap: 10px;
            justify-content: center; /* Center buttons */
            margin-top: 10px; /* Spacing above buttons */
        }

        button {
            padding: 10px;
            background-color: #007bff; /* Primary blue */
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px; /* Rounded corners */
            font-size: 14px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* Light shadow for a 3D effect */
        }

        button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
        .controls {
            display: flex; /* Display buttons in a row */
            background-color: #e0e0e0; /* Same background color as the 3D container */
            padding: 10px; /* Padding around the buttons */
        }

        .controls button {
            background-color: blue; /* Button background color */
            color: white; /* Text color */
            border: none;
            padding: 5px 10px; /* Smaller padding for smaller buttons */
            margin: 0 5px; /* Space between buttons */
            cursor: pointer;
            border-radius: 5px; /* Rounded corners */
            display: flex; /* Flexbox to align items */
            align-items: center; /* Center icon and text vertically */
            font-size: 0.85em; /* Smaller font size */
        }

        .controls button i {
            margin-right: 5px; /* Space between icon and text */
        }

        .controls button:hover {
            background-color: darkblue; /* Darker blue on hover */
        }
        
        .section {
            display: flex;
            align-items: flex-start; /* Align items to the top */
        }

        .gray-background {
            background-color: #e0e0e0; /* Background color for the section */
            padding: 20px; /* Padding around the section */
            border-radius: 5px; /* Rounded corners */
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header Section -->
        <div class="sectionn d-flex align-items-center">
            <div class="text-content">
                <h1><i class="fas fa-print"></i> Professional 3D Printing Service</h1>
                <p>Upload your 3D model to get started with high-quality 3D printing. We support STL and OBJ formats. Simply choose your file, and we’ll take care of the rest.</p>
                <a href="#upload" class="button">Start Your 3D Print</a>
            </div>
            <div class="image-content">
                <img src="<?= base_url('images/print3.png'); ?>" alt="3D Printer" class="image-responsive">
            </div>
        </div>

        <!-- File Upload Section -->
        <div id="upload" class="sectionn">
            <h2><i class="fas fa-file-upload"></i> Upload Your 3D File</h2>
            <form action="/print3d/upload" method="post" enctype="multipart/form-data">
                <div class="file-upload" style="margin-right: 60px;margin-top: 30px">
                    <label for="file"><i class="fas fa-upload"></i> Click here to upload your file (STL or OBJ)</label>
                    <input type="file" id="file" name="file" accept=".stl,.obj" onchange="displayFileName()">
                    <p class="file-info" id="file-info">No file selected yet</p>
                    <button class="upload-button"><i class="fas fa-paper-plane"></i> Send to Printer</button>
                </div>
            </form>
        </div>
        <h1><i class="fas fa-cube icon"></i> 3D Visualization</h1>
        <!-- 3D Visualization Section -->
        <div class="section">
        <div class="gray-background">
           
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

        window.onload = function() {
            // Initialize the scene, camera, and renderer
            var scene = new THREE.Scene();
            var camera = new THREE.PerspectiveCamera(75, 600 / 400, 0.1, 1000);
            var renderer = new THREE.WebGLRenderer({ alpha: true });
            renderer.setSize(600, 400);
            document.getElementById('3d-container').appendChild(renderer.domElement);

            // Load texture from the selected image URL
            var loader = new THREE.TextureLoader();
            var texture = loader.load('images/node1.png', function() {
                // Callback to ensure the image is fully loaded
                texture.anisotropy = renderer.getMaxAnisotropy();
            });

            // Create a plane with the texture applied
            var geometry = new THREE.PlaneGeometry(5, 5);
            var material = new THREE.MeshBasicMaterial({ map: texture });
            var plane = new THREE.Mesh(geometry, material);
            plane.rotation.x = 0; // Set rotation to 0 for normal orientation
            scene.add(plane);

            camera.position.set(0, 2, 5); // Adjust the camera position

            // Animation function (with rotation)
            function animate() {
                if (isAnimating) {
                    plane.rotation.y += 0.01; // Rotate the plane continuously
                }
                renderer.render(scene, camera);
                requestAnimationFrame(animate);
            }
            animate();

            // Restart the animation
            document.getElementById('restart-animation').addEventListener('click', function() {
                isAnimating = true; // Set flag to true to restart animation
                plane.rotation.y = 0; // Reset rotation to initial position
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
        };
    </script>

        <!-- How it Works Section -->
        <h2><i class="fas fa-cogs"></i> How it Works</h2>
        <div class="section">
            <div class="row"> <!-- Create a row for Bootstrap grid -->
                <div class="col-md-4"> <!-- Each box takes up one-third of the row on medium and larger screens -->
                    <div class="info-box">
                        <img src="<?= base_url('images/print.png'); ?>" alt="Upload Icon">
                        <div class="info-box-content">
                            <h3><i class="fas fa-upload"></i> 1. Upload Your File</h3>
                            <p>Select your 3D model in STL or OBJ format and upload it for our 3D printing process. Make sure your design is ready for production.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-box">
                        <img src="<?= base_url('images/print2.png'); ?>" alt="Pricing Icon">
                        <div class="info-box-content">
                            <h3><i class="fas fa-tag"></i> 2. Pricing Calculation</h3>
                            <p>We will analyze your model and provide an accurate price quote based on material and size. You will receive the quote via email.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-box">
                        <img src="<?= base_url('images/print3.png'); ?>" alt="Delivery Icon">
                        <div class="info-box-content">
                            <h3><i class="fas fa-truck"></i> 3. Delivery to Your Doorstep</h3>
                            <p>Once approved, your 3D model will be printed and delivered to you. We ensure high-quality prints and timely delivery.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pricing Table Section -->
        <h2><i class="fas fa-dollar-sign"></i> Pricing Table</h2>
        <div class="section">
            <table class="pricing-table">
                <tr>
                    <th>Material</th>
                    <th>Price per Gram</th>
                    <th>Estimated Print Time</th>
                </tr>
                <tr>
                    <td>PLA</td>
                    <td>$0.02</td>
                    <td>Varies</td>
                </tr>
                <tr>
                    <td>ABS</td>
                    <td>$0.03</td>
                    <td>Varies</td>
                </tr>
                <tr>
                    <td>TPU</td>
                    <td>$0.04</td>
                    <td>Varies</td>
                </tr>
            </table>
        </div>

        <!-- Back Link -->
        <a href="<?= base_url('home'); ?>" class="back-link"><i class="fas fa-arrow-left"></i> Back to Home</a>
    </div>

   
</body>
</html>
