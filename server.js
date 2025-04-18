const express = require('express');
const php = require('php-cgi');  // Usamos php-cgi para ejecutar PHP
const path = require('path');
const app = express();
const port = 10000;

// Configuración para servir los archivos estáticos
app.use(express.static(path.join(__dirname, 'public')));

// Ruta para manejar las solicitudes PHP
app.all('*.php', (req, res) => {
  const phpScript = path.join(__dirname, 'public', req.path);
  php.execute(phpScript, (err, result) => {
    if (err) {
      return res.status(500).send('Error al ejecutar PHP');
    }
    res.send(result);
  });
});

// Rutas adicionales para servir otros archivos estáticos o HTML
app.get('/', (req, res) => {
  res.sendFile(path.join(__dirname, 'public', 'index.php'));
});

// Inicia el servidor en el puerto especificado
app.listen(port, () => {
  console.log(`Servidor PHP corriendo en http://localhost:${port}`);
});
