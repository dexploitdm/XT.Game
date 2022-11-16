import GameRepository from './GameRepository';
import SelectionRepository from './SelectionRepository';
import OrderRepository from './OrderRepository';

const repositories = {
    'games': GameRepository,
    'selection': SelectionRepository,
    'order': OrderRepository,
}
export default {
    get: name => repositories[name]
};
