import * as actionType from '../constants/ActionTypes';

const initialState = sanghaInitialState.members;

export default function members(state = initialState, action) {
    switch (action.type) {
        case actionType.MEMBERS_UPDATED:
            return Object.assign({}, state, {
                members: action.data
            });
        default:
            return state;
    }
}
