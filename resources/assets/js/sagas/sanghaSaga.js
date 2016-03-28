import $ from 'jquery';
import { call, put, take } from 'redux-saga/effects';
import * as actionType from '../constants/ActionTypes';
import { approveMembershipRequestSucceeded, approveMembershipRequestFailed } from '../actions/sangha';

export function* approveMembershipRequest() {
    console.log('I am in the saga');


    while(true) {
        // Wait for the APPROVE_MEMBERSHIP_REQUEST action
        const data  = yield take(actionType.APPROVE_MEMBERSHIP_REQUEST);

        try {
            // Tell redux-saga to call fetch with the specified options
            yield call($.ajax({
                url: '/membership',
                type: 'POST',
                data: {
                    'userId': data.data.userId,
                    'sanghaId': data.data.sanghaId,
                    'approved': true,
                    '_token': data.data._token
                }
            }));

            // Tell redux-saga to dispatch the saveScoreSucceeded action
            console.log('membership approved');
            yield put(approveMembershipRequestSucceeded());
        }
        catch (err)
            {
                yield put(approveMembershipRequestFailed(err));
            }
        }
}
