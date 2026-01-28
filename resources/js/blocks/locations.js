gsap.registerPlugin(ScrollTrigger);

document.addEventListener('DOMContentLoaded', function() {
    const bearing = document.querySelector('.b-locations img[src*="big_bearing"]');
    
    if (bearing) {
        let rotation = 0;
        let velocity = 0;
        const maxVelocity = 2; // Maksymalna prędkość obrotu
        
        ScrollTrigger.create({
            trigger: "body",
            start: "top top",
            end: "bottom bottom",
            onUpdate: (self) => {
                let scrollVel = self.getVelocity() * -0.008;
                
                // Ogranicz maksymalną prędkość
                scrollVel = Math.max(-maxVelocity, Math.min(maxVelocity, scrollVel));
                
                velocity = scrollVel;
            }
        });
        
        gsap.ticker.add(() => {
            // Dodaj velocity do rotation
            rotation += velocity;
            
            // Płynne hamowanie
            velocity *= 0.90;
            
            // Zastosuj
            gsap.set(bearing, { 
                rotation: rotation,
                force3D: true
            });
        });
    }
});