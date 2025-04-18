const express = require('express');
const path = require('path');
const app = express();
const port = 10000;

// Configuración de rutas estáticas
app.use(express.static(path.join(__dirname, 'public')));

// Ruta para la página principal
app.get('/', (req, res) => {
  res.sendFile(path.join(__dirname, 'public', 'index.php'));
});

// Otras rutas estáticas que puedas tener
app.get('/planes', (req, res) => {
  res.sendFile(path.join(__dirname, 'public', 'planes.php'));
});

app.get('/suscripciones', (req, res) => {
  res.sendFile(path.join(__dirname, 'public', 'suscripciones.php'));
});

// Manejo de errores de ruta no definida
app.use((req, res) => {
  res.status(404).send('Ruta no encontrada: ' + req.originalUrl);
});

// Inicia el servidor
app.listen(port, () => {
  console.log(`Servidor escuchando en http://localhost:${port}`);
});
