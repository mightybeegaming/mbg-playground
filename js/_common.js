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