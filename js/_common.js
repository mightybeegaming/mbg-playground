/*
 * Last Updated
 */

function formatTime(sec) {
    let minutes = Math.floor(sec / 60);
    minutes = String(minutes).padStart(2, '0');

    let seconds = sec % 60;
    seconds = String(seconds).padStart(2, '0');

    return minutes + ':' + seconds;
}

function startCountdown() {
    const lastUpdatedElement = document.getElementById('lastUpdated');

    setInterval(() => {
        remaining--;
        if(remaining < 0) remaining = intervalSeconds;

        lastUpdatedElement.textContent = formatTime(remaining);
    }, 1000);
}

let intervalSeconds = 300; // 5 minutes
let remaining = intervalSeconds;
startCountdown();

/*
 * Metrics Builders
 */

function tagBuilder(tags) {
    tags = tags.split('|');

    let stringTags = '';
    for(let i = 0; i < tags.length; i++) {
        stringTags += '<span class="widget tag">' + tags[i] + '</span>';
    }

    return stringTags;
}

function statusBuilder(metrics) {
    const status = [];
    
    let onlinePlayers = metrics.onlinePlayers;
    onlinePlayers = (onlinePlayers > 0) ? onlinePlayers + ' ' : '';

    const onlineIndicator = '<span class="widget status-online">' + onlinePlayers + 'ONLINE</span>';
    const offlineIndicator = '<span class="widget status-offline">OFFLINE</span>';

    const serverStatus = metrics.server.status;
    status.indicator = serverStatus ? onlineIndicator : offlineIndicator;
    status.text = serverStatus ? 'ONLINE' : 'OFFLINE';

    return status;
}

/*
 * Globals
 */
const metricsUpdateInterval = 300000 // 5 minutes