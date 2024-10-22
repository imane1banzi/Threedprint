<?php

namespace App\Controllers;

class Print3D extends BaseController
{
    public function index()
    {
        return view('upload_3dfile');
    }

    public function upload()
    {
        $file = $this->request->getFile('file');
        
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName(); // Nom aléatoire pour éviter les conflits
            $file->move(WRITEPATH . 'uploads', $newName);

            // Après le téléchargement, tu peux envoyer le fichier à l'imprimante
            // en utilisant une API comme OctoPrint
            $this->sendToPrinter(WRITEPATH . 'uploads/' . $newName);
            
            return redirect()->to('/print3d/success');
        } else {
            return redirect()->to('/print3d/failure');
        }
    }

    private function sendToPrinter($filePath)
    {
        // Exemple d'envoi de fichier via API à OctoPrint
        $apiKey = 'TON_API_KEY'; // Remplace par ta clé API OctoPrint
        $url = 'http://TON_IMPRIMANTE:5000/api/files/local';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'X-Api-Key: ' . $apiKey,
            'Content-Type: multipart/form-data'
        ]);

        // Fichier à envoyer
        $postFields = ['file' => new \CURLFile($filePath)];
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}
