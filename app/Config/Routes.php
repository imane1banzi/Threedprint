<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/print3d', 'Print3D::index');
$routes->post('/print3d/upload', 'Print3D::upload');
$routes->get('/print3d/success', function() {
    echo "Le fichier a été envoyé avec succès à l'imprimante.";
});
$routes->get('/print3d/failure', function() {
    echo "Échec de l'envoi du fichier.";
});
$routes->get('/3d-view', 'ThreeDController::index');
$routes->get('upload', 'UploadController::index');
$routes->post('upload-file', 'UploadController::uploadFile');
$routes->get('/view-stl', 'StlViewer::index');

