# Project Template

Helpful/necessary workflow installations:

- [Visual Studio Code](https://code.visualstudio.com/)
- [MAMP](https://www.mamp.info/en/downloads/)
- [Node.js](https://nodejs.org/)
- [npm](https://docs.npmjs.com/getting-started/installing-node)
- [Grunt](https://gruntjs.com/)
- [npm-watch](https://www.npmjs.com/package/npm-watch)
- [Browsersync](https://www.browsersync.io/docs/grunt)
- [WordPress](https://wordpress.org/)

## Setup

### MAMP

Make sure Document root points to files:

> /Users/[user]/Sites

Allow MAMP to use virtual hosts by opening the following file:

> /Applications/MAMP/conf/apache/httpd.conf

And remove the comment on the line under `# Virtual hosts` to look like this:

```
# Virtual hosts
Include /Applications/MAMP/conf/apache/extra/httpd-vhosts.conf
```

To create a virtual host, add an entry to your hosts file:

> /private/etc/hosts

```
127.0.0.1     local.[domain].com
```

Then point to where your files are located in:

> /Applications/MAMP/conf/apache/extra/httpd-vhosts.conf

```
<VirtualHost *:80>
  DocumentRoot "/Users/[user]/Sites/[project]/public"
  ServerName local.[domain].com
</VirtualHost>
```

While you're in this file make sure to update `Listen 8888` to:
```
Listen 80
```

Make sure MAMP settings look like this:

- Apache Port: 80
- Nginx Port: 8080
- MySQL Port: 3306

** Relaunch MAMP/clear browser cache every time you create a new project

For details on how to set up this configuration with SSL [read here](https://stackoverflow.com/a/70017835).

> Note: If issues occur while trying to start MAMP servers try running this command in terminal to debug issues:
```
sudo /Applications/MAMP/Library/bin/apachectl start
```

### New Project

** This build requires a GSAP Premimum License with a `.npmrc` file. Otherwise, remove and adjust dependencies and components as needed.

- Download and rename the _template folder
- In **package.json**, edit any instance of `project-name`
- In **gruntfile.js**, edit the `theme` variable
- In **public/wp-content/themes**, rename **project-name**-theme
- Run `npm install` or `npm i`

## Build

- Launch MAMP
- Run `grunt dev` to build the project for development
- Run `grunt prod` when ready to push to production
- Run `grunt images` to compress images and svg files