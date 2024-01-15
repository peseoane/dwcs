$sourceContainers = @(
    'dwcs-php8:/etc/apache2/apache2.conf',
    'dwcs-php8:/etc/apache2/ports.conf',
    'dwcs-php8:/etc/apache2/sites-available',
    'dwcs-php8:/etc/apache2/sites-enabled',
    'dwcs-php8:/etc/apache2/mods-available'
)

$destinationFolders = @(
    './config/apache2/apache2.conf',
    './config/apache2/ports.conf',
    './config/apache2/sites-available',
    './config/apache2/sites-enabled',
    './config/apache2/mods-available'
)

if ($sourceContainers.Length -ne $destinationFolders.Length) {
    Write-Output "Las listas de contenedores de origen y carpetas de destino no tienen la misma longitud."
    exit 1
}

for ($i = 0; $i -lt $sourceContainers.Length; $i++) {
    $sourceContainer = $sourceContainers[$i]
    $destinationFolder = $destinationFolders[$i]

    docker cp $sourceContainer $destinationFolder
}