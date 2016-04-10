import 'babel-polyfill'
import { createStore, applyMiddleware } from 'redux';
import createSagaMiddleware from 'redux-saga';
import rootReducer from '../reducers/rootReducer';
import { approveMembershipRequest, rejectMembershipRequest, updateNotificationsForSangha } from '../sagas/sanghaSaga';

export default function configureStore(sanghaInitialState) {
    return createStore(
        rootReducer,
        sanghaInitialState,
        applyMiddleware(createSagaMiddleware(approveMembershipRequest, rejectMembershipRequest, updateNotificationsForSangha))
    )
}
