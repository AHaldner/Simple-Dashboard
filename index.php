<?php include 'credentials.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Dashboard</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>
    <?php
    function getSubdomains($subdomainPaths)
    {
        global $basePath; // Access the global $basePath variable

        $subdomains = array();

        foreach ($subdomainPaths as $subdomainPath) {
            $path = $basePath . $subdomainPath;
            $directories = scandir($path);

            foreach ($directories as $directory) {
                if ($directory !== '.' && $directory !== '..' && is_dir($path . $directory)) {
                    $subdomains[] = array(
                        'name' => $directory,
                        'path' => $path
                    );
                }
            }
        }

        return $subdomains;
    }

    function checkWebsiteStatus($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($responseCode === 200) {
            return '<span class="status-ok">OK</span>';
        } else {
            return '<span class="status-error">Error</span>';
        }
    }

    $subdomains = getSubdomains($subdomainPaths);

    if (count($subdomains) > 0) {
        echo '<div>';
        echo '<table>';
        echo '<tr><th>Subdomain</th><th>Status</th><th>Size</th></tr>';

        foreach ($subdomains as $subdomain) {
            $subdomainUrl = $subdomain['name'] . '.' . $mainDomain;
            $status = checkWebsiteStatus('http://' . $subdomainUrl);
            $size = getDirectorySize($subdomain['path'] . $subdomain['name']);

            if ($size > 0) {
                echo '<tr><td><a href="http://' . $subdomainUrl . '" target="_blank">' . $subdomainUrl . '</a></td><td>' . $status . '</td><td>' . formatSizeUnits($size) . '</td></tr>';
            }
        }

        echo '</table>';
        echo '</div>';
    } else {
        echo 'No subdomains found.';
    }

    function formatSizeUnits($bytes)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');
        $i = 0;

        while ($bytes >= 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    function getDirectorySize($path)
    {
        $totalSize = 0;

        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS));

        foreach ($iterator as $file) {
            $totalSize += $file->getSize();
        }

        return $totalSize;
    }
    ?>
</body>

</html>