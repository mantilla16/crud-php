const express = require('express');
const php = require('php-cgi');  // Usamos php-cgi para ejecutar PHP
const path = require('path');
const app = express();
const port = 10000;

// Configuración para servir los archivos estáticos
app.use(express.static(path.join(__dirname, 'public')));

// Ruta para manejar solicitudes PHP
app.all('*.php', (req, res) => {
  const phpScript = path.join(__dirname, 'public', req.path);
  
  // Verificamos si el archivo PHP realmente existe antes de intentar ejecutarlo
  const fs = require('fs');
  if (fs.existsSync(phpScript)) {
    php.execute(phpScript, (err, result) => {
      if (err) {
        return res.status(500).send('Error al ejecutar PHP: ' + err.message);
      }
      res.send(result);
    });
  } else {
    res.status(404).send('Archivo PHP no encontrado: ' + phpScript);
  }
});

// Ruta para servir el archivo index.php
app.get('/', (req, res) => {
  res.sendFile(path.join(__dirname, 'public', 'index.php'));
});

app.get('/planes', (req, res) => {
    res.sendFile(path.join(__dirname, 'public', 'planes.php'));
  });
  
  app.get('/suscripciones', (req, res) => {
    res.sendFile(path.join(__dirname, 'public', 'suscripciones.php'));
  });
  

// Middleware para manejar rutas no definidas
app.use((req, res, next) => {
  console.log(`Ruta solicitada: ${req.originalUrl}`);
  res.status(404).send('Ruta no encontrada: ' + req.originalUrl);
});

// Inicia el servidor en el puerto especificado
app.listen(port, () => {
  console.log(`Servidor PHP corriendo en http://localhost:${port}`);
});
