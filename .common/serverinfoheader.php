<div class="server-info-header">
    <h1>Server Information</h1>
    <div class="server-time" id="serverTime"><?=date('g:i:s A')?></div>
</div>

<script>
    const serverTimeContainer = document.getElementById('serverTime');

    function parseTime12h(timeStr) {
        const parts = timeStr.split(' ');
        const time = parts[0];
        const modifier = parts[1];

        let [hours, minutes, seconds] = time.split(':').map(Number);

        if(modifier === 'PM' && hours !== 12) hours += 12;
        if(modifier === 'AM' && hours === 12) hours = 0;

        return {hours, minutes, seconds};
    }

    function formatTime12h(date) {
        let hours = date.getHours();
        const minutes = String(date.getMinutes()).padStart(2, '0');
        const seconds = String(date.getSeconds()).padStart(2, '0');

        const ampm = hours >= 12 ? 'PM' : 'AM';

        hours = hours % 12;
        if(hours === 0) hours = 12;

        return `${hours}:${minutes}:${seconds} ${ampm}`;
    }

    const parsed = parseTime12h(serverTimeContainer.textContent);

    const now = new Date();
    now.setHours(parsed.hours);
    now.setMinutes(parsed.minutes);
    now.setSeconds(parsed.seconds);

    function updateClock() {
        now.setSeconds(now.getSeconds() + 1);
        serverTimeContainer.textContent = formatTime12h(now);
    }

    updateClock();
    setInterval(updateClock, 1000);
</script>