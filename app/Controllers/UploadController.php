<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class UploadController extends Controller
{
    public function index()
    {
        // Charge la vue pour l'upload du fichier
        return view('upload_view');
    }

    public function uploadFile()
    {
        // Récupérer l'instance de la requête HTTP
        $file = $this->request->getFile('stl_file');
        
        // Vérifier si le fichier a été correctement uploadé
        if (!$file->isValid()) {
            return redirect()->back()->with('error', $file->getErrorString());
        }

        // Vérifier le type de fichier (ici .stl)
        if ($file->getClientExtension() != 'stl') {
            return redirect()->back()->with('error', 'Seuls les fichiers .stl sont autorisés');
        }

        // Définir le chemin d'upload
        $newName = $file->getRandomName();
        $file->move(WRITEPATH . 'uploads', $newName);

        // Récupérer le chemin complet du fichier pour l'afficher
        $filePath = base_url('writable/uploads/' . $newName);

        // Retourner la vue avec le chemin du fichier pour l'afficher
        return view('upload_view', ['file_path' => $filePath]);
    }
}
