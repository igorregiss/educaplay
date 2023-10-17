<?php
// Verifique se o arquivo foi enviado com sucesso
if (isset($_FILES['upload']) && $_FILES['upload']['error'] === UPLOAD_ERR_OK) {
    $uploadedFile = $_FILES['upload'];

    // Verifique o tipo de arquivo (você pode adicionar mais tipos conforme necessário)
    $allowedTypes = array('image/jpeg', 'image/png', 'image/gif');
    if (in_array($uploadedFile['type'], $allowedTypes)) {
        // Diretório onde os arquivos serão armazenados
        $uploadDirectory = 'assets/img';

        // Garanta que o diretório de upload exista
        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
        }

        // Gere um nome de arquivo único com extensão
        $fileName = uniqid() . '.' . pathinfo($uploadedFile['name'], PATHINFO_EXTENSION);

        // Mova o arquivo para o diretório de upload
        if (move_uploaded_file($uploadedFile['tmp_name'], $uploadDirectory . $fileName)) {
            // URL do arquivo de imagem após o upload (pode ser ajustado conforme sua estrutura de diretório)
            $fileUrl = $uploadDirectory . $fileName;

            // Retorne a URL da imagem para o CKEditor
            echo json_encode(array('url' => $fileUrl));
        } else {
            echo json_encode(array('error' => 'Erro ao mover o arquivo de upload.'));
        }
    } else {
        echo json_encode(array('error' => 'Tipo de arquivo não suportado. Apenas JPEG, PNG e GIF são permitidos.'));
    }
} else {
    echo json_encode(array('error' => 'Erro no envio do arquivo.'));
}
?>
