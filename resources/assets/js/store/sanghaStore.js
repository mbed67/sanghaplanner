import 'babel-polyfill'
import { createStore, applyMiddleware } from 'redux';
import createSagaMiddleware from 'redux-saga';
import rootReducer from '../reducers/rootReducer';
import { helloSaga } from '../sagas/helloSaga';

const store = createStore(
    rootReducer,
    applyMiddleware(createSagaMiddleware(helloSaga))
);

export default function sanghaStore() {
    return store;
};
