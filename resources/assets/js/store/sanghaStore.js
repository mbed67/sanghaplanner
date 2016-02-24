import { createStore, applyMiddleware } from 'redux';
import thunk from 'redux-thunk';
import rootReducer from '../reducers/rootReducer';

const createStoreWithMiddleware = applyMiddleware(
    thunk
)(createStore);

export default function sanghaStore(initialState) {
    return createStoreWithMiddleware(rootReducer, initialState);
};
