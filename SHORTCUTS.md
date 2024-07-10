# Terminal Command Shortcuts
Cheat sheet of shortcuts to assist with common development tasks.

## Setup

Make sure the following are already completed:<br>
- [Create SSH Key & Add Key to Rocket.net](https://support.rocket.net/hc/en-us/articles/7824577151515-How-to-use-SSH-and-WP-CLI-from-the-Command-Line)
- [Installing WP-CLI](https://make.wordpress.org/cli/handbook/guides/installing/) 

> Note: If `php` command is not working when installing WP-CLI make sure to check if it's installed using `php -v`. If it's not installed you can install it using `brew install php`.

## SSH Key
```
pbcopy < ~/.ssh/id_rsa.pub
```

## Login
```
ssh sftpusername@FTPAddress
cd public_html
```

## Common 

- `pwd` to get full pathname of current directory
- `ls` to get list of files and directories
- `cd` to change directory
- `mkdir` to make directory
- `rm` or `rmdir` to remove files or directories

## Wordpress
The following commands do not require to be logged in via SSH. If you are logged in `exit` before copying the commands below. However, you can still use `wp` commands while logged in, but you do not need to include `--ssh` or `--path`. 

> Note: On [Rocket.net](https://rocket.net) `scp` commands only worked when logged out of `ssh`.

### Show plugins
```
wp plugin list --ssh=sftpusername@FTPAddress --path="/home/sftpusername/public_html"
```
or 
```
wp plugin list
```

### Remove plugins
```
wp plugin uninstall hello --deactivate --ssh=sftpusername@FTPAddress --path="/home/sftpusername/public_html"
wp plugin uninstall akismet --deactivate --ssh=sftpusername@FTPAddress --path="/home/sftpusername/public_html"
```
or
```
wp plugin uninstall hello --deactivate
wp plugin uninstall akismet --deactivate
```

### Install plugins
```
wp plugin install all-in-one-wp-migration --activate --ssh=sftpusername@FTPAddress --path="/home/sftpusername/public_html"
```
or
```
wp plugin install all-in-one-wp-migration --activate
```

### Upload ai1wm extension
```
scp -r ~/Desktop/Wordpress/wp-content/plugins/all-in-one-wp-migration-unlimited-extension sftpusername@FTPAddress:/home/sftpusername/public_html/wp-content/plugins
```

## All in One WP Migration
The following commands do not require to be logged in via SSH. If you are logged in `exit` before copying the commands below. However, you can still use `wp` commands while logged in, but you do not need to include `--ssh` or `--path`.

> Note: On [Rocket.net](https://rocket.net) `scp` commands only worked when logged out of `ssh`.

### Create ai1wm backup
```
wp ai1wm backup --ssh=sftpusername@FTPAddress --path="/home/sftpusername/public_html"
```
or
```
wp ai1wm backup
```

### Get ai1wm backup list
```
wp ai1wm list-backups --ssh=sftpusername@FTPAddress --path="/home/sftpusername/public_html"
```
or
```
wp ai1wm list-backups
```

### Download ai1wm backup
```
scp sftpusername@FTPAddress:/home/sftpusername/public_html/wp-content/ai1wm-backups/COPY_BACKUP_NAME.wpress ~/Downloads
```

### Import ai1wm backup
```
scp ~/Downloads/COPY_BACKUP_NAME.wpress sftpusername@FTPAddress:/home/sftpusername/public_html/wp-content/ai1wm-backups
```