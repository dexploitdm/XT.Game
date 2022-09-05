import GameRepository from './GameRepository';
import SelectionRepository from './SelectionRepository';

const repositories = {
    'games': GameRepository,
    'selection': SelectionRepository,
}
export default {
    get: name => repositories[name]
};
