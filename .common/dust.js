
const canvas = document.getElementById("dust");
const ctx = canvas.getContext("2d");

canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

let dustParticles = [];
const particleCount = 256;

const mouse = {
    x: null,
    y: null,
    radius: 120
};

document.addEventListener("mousemove", (event) => {
    mouse.x = event.clientX;
    mouse.y = event.clientY;
});

document.addEventListener("mouseleave", () => {
    mouse.x = null;
    mouse.y = null;
});

class Dust {
    constructor() {
        this.reset();
    }

    reset() {
        this.x = Math.random() * canvas.width;
        this.y = Math.random() * canvas.height;
        this.size = Math.random() * 2 + 0.3;
        this.baseSpeedX = (Math.random() - 0.5) * 0.2;
        this.baseSpeedY = Math.random() * -0.3 - 0.05;
        this.speedX = this.baseSpeedX;
        this.speedY = this.baseSpeedY;
        this.alpha = Math.random() * 0.5 + 0.1;
    }

    update() {
        // mouse interaction
        if (mouse.x !== null && mouse.y !== null) {
            const dx = this.x - mouse.x;
            const dy = this.y - mouse.y;
            const distance = Math.sqrt(dx * dx + dy * dy);

            if (distance < mouse.radius) {
                const force = (mouse.radius - distance) / mouse.radius;

                this.speedX += dx * force * 0.01;
                this.speedY += dy * force * 0.01;
            }
        }

        // slowly return to base speed
        this.speedX += (this.baseSpeedX - this.speedX) * 0.02;
        this.speedY += (this.baseSpeedY - this.speedY) * 0.02;

        this.x += this.speedX;
        this.y += this.speedY;

        if (this.y < 0 || this.x < 0 || this.x > canvas.width) {
            this.reset();
            this.y = canvas.height;
        }
    }

    draw() {
        ctx.beginPath();

        ctx.arc(this.x, this.y, this.size, 0, Math.PI*2);

        ctx.fillStyle = `rgba(255,255,255,${this.alpha})`;

        // GLOW SETTINGS
        ctx.shadowBlur = 15;
        ctx.shadowColor = "rgba(255,154,103,1)";

        ctx.fill();

        // reset shadow so fog isn't affected
        ctx.shadowBlur = 0;
    }
}

for (let i = 0; i < particleCount; i++) {
    dustParticles.push(new Dust());
}

function animate() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    dustParticles.forEach(p => {
        p.update();
        p.draw();
    });

    requestAnimationFrame(animate);
}

animate();

window.addEventListener("resize", () => {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
});