const Router = require('express');
const router = new Router();
const brandController = require('../conrollers/brandController');

router.post('/', brandController.create);
router.get('/', brandController.getAll);

module.exports = router;