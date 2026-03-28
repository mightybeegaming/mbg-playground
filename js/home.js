async function loadServerMetrics() {
    const response = await fetch('/php/metrics.php?server=all', {'cache': 'no-store'});
    const metrics = await response.json();

    Object.entries(metrics).forEach(([server, data]) => {
        server = server.toLowerCase();

        const status = statusBuilder(data);
        const statusElement = document.getElementById(`status-${server}`);
        statusElement.innerHTML = status.indicator;

        const tagsElement = document.getElementById(`tags-${server}`);
        tagsElement.innerHTML = tagBuilder(data.tags);
    });

    remaining = intervalSeconds;
}
setInterval(loadServerMetrics, metricsUpdateInterval);
loadServerMetrics();