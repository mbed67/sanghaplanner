import * as actionType from '../constants/ActionTypes';

const initialState = sanghaInitialState.modals;

export default function modals(state = initialState, action) {
    let updatedModals;

    switch (action.type) {
        case actionType.HIDE_MODAL:
            updatedModals = state;

            for(let modal in updatedModals) {
                if(updatedModals.hasOwnProperty(modal) && modal === action.modalType) {
                    updatedModals[modal]['show'] = false;
                }
            }

            return Object.assign({}, state, {
                modals: updatedModals
            });
        case actionType.SHOW_MODAL:
            updatedModals = state;

            for(let modal in updatedModals) {
                if(updatedModals.hasOwnProperty(modal) && modal === action.modalType) {
                    updatedModals[modal]['show'] = true;
                }
            }

            return Object.assign({}, state, {
                modals: updatedModals
            });
        default:
            return state;
    }
}
