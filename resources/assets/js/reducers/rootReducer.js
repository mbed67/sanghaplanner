import { combineReducers } from 'redux';
import security from './security.js';
import sangha from './sangha.js';
import admins from './admins';
import notifications from './notifications';
import retreats from './retreats';

const rootReducer = combineReducers({
    security,
    sangha,
    admins,
    notifications,
    retreats
});

export default rootReducer;