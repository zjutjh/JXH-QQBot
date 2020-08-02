import React from 'react';
// @ts-ignore
import {Card, ICardTokens, ICardSectionStyles, ICardSectionTokens} from '@uifabric/react-cards';
import {Image, PrimaryButton, Stack, Text, TextField} from 'office-ui-fabric-react';
import {AnimationClassNames, mergeStyles, mergeStyleSets} from "office-ui-fabric-react/lib/Styling";

const backgroundCoverStyle = mergeStyles([
    {
        zIndex: 0,
        height: '100%',
        width: '100%',
        position: "fixed",
        display: "table",
        backgroundRepeat: 'no-repeat',
        backgroundSize: 'cover',
        backgroundPosition: 'center 0',
        backgroundImage: 'url(https://www.setaswall.com/wp-content/uploads/2017/11/Twitter-Cover-Photo-42-1500x500.jpg)'
    },
    AnimationClassNames.scaleUpIn100,
]);
export const LoginView: React.FunctionComponent = () => {
    return (
        <div className={backgroundCoverStyle}>
            <div style={{display: 'table-cell', verticalAlign: 'middle'}}>
                <Card aria-label="Basic vertical card" style={{
                    backgroundColor: "white",
                    margin: "auto",
                    padding: '1.5rem'

                }}>
                    <Card.Item>
                        <Text>Basic vertical card</Text>
                        <TextField style={{
                            margin: '50px'
                        }}/>
                        <PrimaryButton text="Login" allowDisabledFocus/>
                    </Card.Item>
                </Card>
            </div>

        </div>
    );
};
