import * as actionType from '../constants/ActionTypes';

const initialState = sanghaInitialState.notifications;

export default function notifications(state = initialState, action) {
    switch (action.type) {
        case actionType.NOTIFICATIONS_UPDATED:
            return Object.assign({}, state, {
                notifications: action.data
    });
        default:
            return state;
    }
}
