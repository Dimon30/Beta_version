const Router = require('express');
const router = new Router();
const typeController = require('../conrollers/typeContoller');

router.post('/', typeController.create);
router.get('/', typeController.getAll);

module.exports = router;