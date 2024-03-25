<!-- PROJECT BADGES -->
<div align="center">

![Version][version-badge]
[![Stars][stars-badge]][stars-url]
[![License][license-badge]][license-url]

</div>


<!-- PROJECT LOGO -->
<br />
<div align="center">
  <img src="https://raw.githubusercontent.com/presentkim-pm/ResourcePackCdn/main/assets/icon.png" alt="Logo" width="80" height="80">
  <h3>ResourcePackCdn</h3>
  <p align="center">
    An plugin that automatically link resource packs to cdn urls!

[Contact to me][author-discord] · [Report a bug][issues-url] · [Request a feature][issues-url]

  </p>
</div>


<!-- ABOUT THE PROJECT -->

## About The Project

Do you know that PMMP's resource pack sending is veryvery slow, and we can provide a resource pack via an external URL
instead?  
Already someone is using a CDN server to provide a resource pack...  
This plugin created for someone (like me) using the server's resource pack folder as a CDN folder!

Just use this plugin to link resource packs to cdn urls as automatically!

#### About configurations

This plugin provides several configurations for a wide range of people to use

```yaml
# The base url of the resource pack cdn
base_url: "https://cdn.example.com/"

# The directory where the resource packs are stored
base_dir: "./resource_packs"

# Whether to remove the extension from the resource pack file name
remove_extension: false
```

- `base_url` : The base url of the resource pack cdn  
  This option for set the url address of the cdn server.
  Values such as 'localhost' are not supported because they are used by the player.
  Must be a valid public url address.

- `base_dir` : The directory where the resource packs are stored  
  This option for set the cdn base directory.
  The path is set based on the PMMP's directory, so './resource_pack' above is the default resource pack path.
  This plug-in does not register a resource pack for that path to the server.
  It only link to the cdn url, if resource pack file is under this path.

- `remove_extension` : Whether to remove the extension from the resource pack file name  
  This option for using if the cdn server omits the extension of the file.
  For example, if you using [alvin's 'ResourcePackCDN'](https://github.com/alvin-pm-pl/ResourcePackCDN),
  this option should be set to `true`.

> If you want to set up a separate CDN url for each resource pack,
> use [alvin's 'Remote Resource Pack'](https://github.com/alvin-pm-pl/RemoteResourcePack)

##

-----

## Target software:

This plugin officially only works with [`Pocketmine-MP`](https://github.com/pmmp/PocketMine-MP/).

##

-----

## Downloads

### Download from [Github Releases][releases-url]

[![Github Downloads][release-badge]][releases-url]

##

-----

## Installation

1) Download plugin `.phar` releases
2) Move downloaded `.phar` file to server's **/plugins/** folder
3) Restart the server

##

-----

## License

Distributed under the **LGPL 3.0**. See [LICENSE][license-url] for more information

##

-----

[author-discord]: https://discordapp.com/users/345772340279508993

[poggit-ci-badge]: https://poggit.pmmp.io/ci.shield/presentkim-pm/ResourcePackCdn/ResourcePackCdn?style=for-the-badge

[poggit-version-badge]: https://poggit.pmmp.io/shield.api/ResourcePackCdn?style=for-the-badge

[poggit-downloads-badge]: https://poggit.pmmp.io/shield.dl.total/ResourcePackCdn?style=for-the-badge

[version-badge]: https://img.shields.io/github/v/release/presentkim-pm/ResourcePackCdn?display_name=tag&style=for-the-badge&label=VERSION

[release-badge]: https://img.shields.io/github/downloads/presentkim-pm/ResourcePackCdn/total?style=for-the-badge&label=GITHUB%20

[stars-badge]: https://img.shields.io/github/stars/presentkim-pm/ResourcePackCdn.svg?style=for-the-badge

[license-badge]: https://img.shields.io/github/license/presentkim-pm/ResourcePackCdn.svg?style=for-the-badge

[poggit-ci-url]: https://poggit.pmmp.io/ci/presentkim-pm/ResourcePackCdn/ResourcePackCdn

[poggit-release-url]: https://poggit.pmmp.io/p/ResourcePackCdn

[stars-url]: https://github.com/presentkim-pm/ResourcePackCdn/stargazers

[releases-url]: https://github.com/presentkim-pm/ResourcePackCdn/releases

[issues-url]: https://github.com/presentkim-pm/ResourcePackCdn/issues

[license-url]: https://github.com/presentkim-pm/ResourcePackCdn/blob/main/LICENSE

[project-icon]: https://raw.githubusercontent.com/presentkim-pm/ResourcePackCdn/main/assets/icon.png

[project-preview]: https://raw.githubusercontent.com/presentkim-pm/ResourcePackCdn/main/assets/preview.gif
