import React from 'react';
import logo from './fabric.png';
import { Image } from 'office-ui-fabric-react/lib/Image';

export const AboutView: React.FunctionComponent = () => {
    return (
        <div>
            About
            <Image
                src={"../assets/img/fabric.png"}
                alt="Example with no image fit value and height or width is specified."
                width={100}
                height={100}
            />
        </div>
    );
};
