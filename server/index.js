require('dotenv').config();
const express = require('express');
const sequelize = require('./db');
const models = require('./models/models');
const cors = require('cors');
const fileUpload = require('express-fileupload');
const PORT = process.env.PORT;
const app = express();
const router = require('./routes/index');
const errorHandler = require('./middleware/ErrorHandlingMiddleware');
const path = require('path');

app.use(cors());
app.use(express.json());
app.use(express.static(path.resolve(__dirname, 'static')));
app.use(fileUpload({}));
app.use('/api', router); 

//Last call
app.use(errorHandler);

/*
app.get('/', (req, res) => {
  res.status(200).json({message: 'CGSG forever!!!'});
})*/

const start = async () => {
  try
  {
    await sequelize.authenticate()
    await sequelize.sync()
    app.listen(PORT, () => console.log('Server started on port ' + PORT));
  }
  catch (error)
  {
    console.log(error);
  }
}

start()