<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3D STL Visualization</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/loaders/STLLoader.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/controls/OrbitControls.js"></script>
    <style>
        body { 
            margin: 0; 
            font-family: 'Arial', sans-serif; 
            background-color: #ffffff; /* Fully white background */
            color: #343a40; 
        }
        h1 {
            color: #17a2b8; /* Title color */
        }
        #viewer { 
            width: 400px; /* Width */
            height: 400px; /* Height */
            position: relative; 
            background: #fff; /* White background */
            border: 1px solid #17a2b8; 
            border-radius: 5px; 
            margin-bottom: 20px;
        }
        #controls { 
            position: absolute; 
            top: 10px; 
            left: 10px; 
            z-index: 1; 
            display: flex; 
            flex-direction: column; 
        }
        button { 
            margin: 5px; 
            padding: 10px; 
            font-size: 14px; 
            background-color: #17a2b8; 
            color: #fff; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
            transition: background-color 0.3s;
            border: 2px solid transparent; 
        }
        button:hover { 
            background-color: #138496; 
            border: 2px solid #fff; 
        }

        /* Styles for the file upload */
        .file-upload {
            position: relative;
            margin-bottom: 20px;
        }
        .file-upload label {
            display: inline-block;
            padding: 10px 20px;
            background-color: #17a2b8;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            border: 2px solid transparent;
        }
        .file-upload label:hover {
            background-color: #138496;
            border: 2px solid #fff;
        }
        .file-upload input[type="file"] {
            display: none; /* Hide the default file input */
        }
        .file-info {
            margin-top: 10px;
            font-size: 14px;
            color: #6c757d; /* Color for file info text */
        }
    </style>
</head>
<body>

    <div class="container mt-4">
        <h1 class="text-center">3D STL Visualization</h1>

        <div class="file-upload">
            <label for="stl_file"><i class="fas fa-upload"></i> Click here to upload your file (STL or OBJ)</label>
            <input type="file" id="stl_file" name="stl_file" accept=".stl,.obj" onchange="displayFileName()">
            <p class="file-info" id="file-info">No file selected</p>
        </div>

        <button id="load_button" class="upload-button"><i class="fas fa-paper-plane"></i> Visualize</button>

        <div id="controls">
            <button id="zoom_in">Zoom In</button>
            <button id="zoom_out">Zoom Out</button>
            <button id="view_front">Front View</button>
            <button id="view_top">Top View</button>
            <button id="view_side">Side View</button>
        </div>

        <div id="viewer"></div>
    </div>

    <script>
        let scene, camera, renderer, controls, mesh;

        function init() {
            // Create the scene, camera, and renderer
            scene = new THREE.Scene();
            camera = new THREE.PerspectiveCamera(75, 300 / 300, 0.1, 1000);
            renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
            renderer.setSize(400, 400); // Limit the size of the rendering
            document.getElementById('viewer').appendChild(renderer.domElement);
            
            // Set the background color to white
            renderer.setClearColor(0xffffff, 1); // White background

            // Add ambient light
            const ambientLight = new THREE.AmbientLight(0x404040); 
            scene.add(ambientLight);

            const directionalLight = new THREE.DirectionalLight(0xffffff, 1); 
            directionalLight.position.set(20, 20, 20).normalize();
            scene.add(directionalLight);

            camera.position.z = 20; // Position the camera
            controls = new THREE.OrbitControls(camera, renderer.domElement);
        }

        function loadSTL(file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const contents = event.target.result;
                const loader = new THREE.STLLoader();
                const geometry = loader.parse(contents);
                const material = new THREE.MeshStandardMaterial({ color: "#17a2b8" }); 
                mesh = new THREE.Mesh(geometry, material);
                scene.add(mesh);
                animate();
            };
            reader.readAsArrayBuffer(file);
        }

        function displayFileName() {
            const fileInput = document.getElementById('stl_file');
            const fileInfo = document.getElementById('file-info');
            fileInfo.textContent = fileInput.files.length > 0 ? fileInput.files[0].name : "No file selected";
        }

        document.getElementById('load_button').addEventListener('click', function() {
            const fileInput = document.getElementById('stl_file');
            if (fileInput.files.length > 0) {
                loadSTL(fileInput.files[0]);
            } else {
                alert("Please select an STL file.");
            }
        });

        function animate() {
            requestAnimationFrame(animate);
            if (mesh) {
                mesh.rotation.x += 0.01; 
                mesh.rotation.y += 0.01;
            }
            controls.update();
            renderer.render(scene, camera);
        }

        document.getElementById('zoom_in').addEventListener('click', function() {
            camera.position.z -= 0.5; 
        });

        document.getElementById('zoom_out').addEventListener('click', function() {
            camera.position.z += 0.5; 
        });

        document.getElementById('view_front').addEventListener('click', function() {
            camera.position.set(0, 0, 20);
            controls.update();
        });

        document.getElementById('view_top').addEventListener('click', function() {
            camera.position.set(0, 20, 0);
            controls.update();
        });

        document.getElementById('view_side').addEventListener('click', function() {
            camera.position.set(20, 0, 0);
            controls.update();
        });

        window.onload = init;
    </script>
</body>
</html>
