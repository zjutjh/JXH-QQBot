import React from 'react';
import {HeaderBar} from './components/HeaderBar'

export class App extends React.Component {

    render() {
        const {children} = this.props;
        return (
            <div>
                <HeaderBar/>
                <div>
                    {children}
                </div>

            </div>
        );
    }

};
