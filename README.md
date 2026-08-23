# MBG Playground
This website is built to help players quickly check server availability and stay connected with the MBG Playground community.

The goal is to make server information easy to access without needing to join the game first.

## Features
- See available game servers at a glance.
- Check server uptime.
- View current players online.

## Metrics API

### Endpoint
`GET /php/metrics.php`

### Parameter | `server` (Required)
| Values            | Description                       |
|:-                 |:-                                 |
| `palworld`        | Palworld server metrics.          |
| `projectZomboid`  | Project Zomboid server metrics.   |
| `vRising`         | V Rising server metrics.          |
| `valheim`         | Valheim server metrics.           |
| `all`             | Returns all server metrics.       |

### Example
`GET /php/metrics.php?server=all`

## Related Links
- Discord Invite Template - https://github.com/Ed0ardo/DiscordInvite