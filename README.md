# Subdomain Dashboard

The Subdomain Dashboard is a PHP script that displays information about subdomains hosted within a specific main domain. It retrieves the subdomains, their status, and the size of their corresponding directories. The script is designed to be used in a web server environment.

## Prerequisites

To use the Subdomain Dashboard, you need the following:

- PHP installed on your web server (version 5.6 or higher)
- The cURL extension enabled in PHP
- Proper directory permissions to access the subdomain directories

## Installation

1. Clone or download the repository to your web server directory.

2. Open a terminal and navigate to the root directory of the Subdomain Dashboard.

3. Make the setup script executable by running the following command:

```shell
chmod +x setup.sh
```

4. Run the `setup.sh` script by executing the following command:

```shell
./setup.sh
```

Follow the prompts to enter your domain, base path, and subdomain paths. The script will create the `credentials.php` file with the provided information.

5. Compile the SCSS file:

- Install a SCSS compiler of your choice if you haven't already.
- Open the `styles/style.scss` file in a text editor.
- Customize the styles as needed.
- Compile the SCSS file into CSS.
- Save the compiled CSS file as `styles/style.css`.

6. Update the HTML:

- Open the `index.php` file in a text editor.
- Update the `<link>` tag for the styles to point to the compiled CSS file: `<link rel="stylesheet" href="styles/style.css">`.

7. Access the dashboard by visiting the `index.php` file in your web browser.

Note: The setup script simplifies the configuration process by allowing you to enter the domain, base path, and subdomain paths interactively. Alternatively, you can manually modify the `$mainDomain` variable and the `$subdomainPaths` array directly in the `credentials.php` file if you prefer manual configuration.

## Usage

Upon accessing the dashboard, it will display a table listing the subdomains, their status, and the size of their corresponding directories. The status indicates whether the subdomain is reachable (200 OK) or if an error occurred.

- Subdomain: Clicking on a subdomain link will open it in a new tab.

- Status: The status column shows "OK" for reachable subdomains and "Error" for subdomains that encountered an issue.

- Size: The size of the subdomain directory is displayed in bytes, kilobytes (KB), megabytes (MB), gigabytes (GB), or terabytes (TB) depending on the size.

## Customization

You can customize the dashboard further to fit your requirements:

- Styling: Modify the `styles/style.scss` file to adjust the styles. Compile it into CSS.

- Additional functionality: Extend the script to include additional features or integrate it into a larger application as needed.

## Troubleshooting

If you encounter any issues or errors, here are some common troubleshooting steps:

1. Check the PHP version: Ensure that your server meets the minimum PHP version required by the script.

2. Verify cURL extension: Confirm that the cURL extension is enabled in your PHP configuration.

3. Directory permissions: Make sure the web server has the necessary permissions to access the subdomain directories.

4. Error reporting: If you're experiencing problems, enable error reporting in PHP to get more detailed error messages.

## License

This Subdomain Dashboard is released under the [MIT License](LICENSE).

Feel free to modify and customize it to suit your needs.
