import { combineReducers } from 'redux';
import security from './security.js';
import sangha from './sangha.js';
import admins from './admins';
import notifications from './notifications';
import members from './members';
import retreats from './retreats';
import routes from './routes';
import modals from './modals';

const rootReducer = combineReducers({
    security,
    sangha,
    admins,
    notifications,
    members,
    retreats,
    routes,
    modals
});

export default rootReducer;
