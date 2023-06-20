#!/bin/bash

# Get user input for domain, base path, and subdomain paths
read -p "Enter your domain: " domain
read -p "Enter your base path (without leading slash): " basePathInput

# Add leading slash to base path
basePath="/$basePathInput"

read -p "Enter the number of subdomain paths: " subdomainCount

subdomainPaths=()
for ((i = 1; i <= subdomainCount; i++)); do
    read -p "Enter subdomain path $i (without leading slash): " subdomainPathInput
    subdomainPath="/$subdomainPathInput/"
    subdomainPaths+=("$subdomainPath")
done

# Create credentials.php file with the user input
credentialsFile=$(cat <<PHP
<?php
\$mainDomain = '$domain';
\$basePath = '$basePath';
\$subdomainPaths = [
    $(printf "'%s',\n" "${subdomainPaths[@]}")
];
?>
PHP
)

echo "$credentialsFile" > credentials.php

echo "Setup completed successfully!"