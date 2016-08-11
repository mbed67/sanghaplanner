import * as actionType from '../constants/ActionTypes';

const initialState = sanghaInitialState.retreats;

export default function retreats(state = initialState, action) {
    switch (action.type) {
        case actionType.RETREATS_UPDATED:
            return Object.assign({}, state, {
                retreats: action.data
            });
        default:
            return state;
    }
}
