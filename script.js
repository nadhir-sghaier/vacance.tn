document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('map')) {
      const map = L.map('map').setView([34.0, 9.0], 6);
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
      }).addTo(map);
  
      const locations = [
        { name: 'Tunis', lat: 36.8065, lon: 10.1815 },
        { name: 'Djerba', lat: 33.8076, lon: 10.8451 },
        { name: 'Tozeur', lat: 33.9197, lon: 8.1335 }
      ];
  
      locations.forEach(loc => {
        L.marker([loc.lat, loc.lon]).addTo(map).bindPopup(loc.name);
      });
    }
  });
  