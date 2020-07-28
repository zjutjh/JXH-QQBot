import * as React from 'react';
import {Fabric} from 'office-ui-fabric-react/lib/Fabric';
import {DetailsList, DetailsListLayoutMode, IColumn} from 'office-ui-fabric-react/lib/DetailsList';
import {mergeStyleSets} from 'office-ui-fabric-react/lib/Styling';
import {IDictioary} from "../interface/IDictionary";
import {apiMap, FetchAPI} from "../utils/Api";

const classNames = mergeStyleSets({
    fileIconHeaderIcon: {
        padding: 0,
        fontSize: '16px',
    },
    fileIconCell: {
        textAlign: 'center',
        selectors: {
            '&:before': {
                content: '.',
                display: 'inline-block',
                verticalAlign: 'middle',
                height: '100%',
                width: '0px',
                visibility: 'hidden',
            },
        },
    },
    fileIconImg: {
        verticalAlign: 'middle',
        maxHeight: '16px',
        maxWidth: '16px',
    },
    controlWrapper: {
        display: 'flex',
        flexWrap: 'wrap',
    },
    exampleToggle: {
        display: 'inline-block',
        marginBottom: '10px',
        marginRight: '30px',
    },
    selectionDetails: {
        marginBottom: '20px',
    },
});
const controlStyles = {
    root: {
        margin: '0 30px 20px 0',
        maxWidth: '300px',
    },
};

export interface IDetailsListDocumentsExampleState {
    columns: IColumn[];
    items: IDictioary[];
}


export class DictionaryList extends React.Component<{}, IDetailsListDocumentsExampleState> {
    private _allItems: IDictioary[];

    constructor(props: {}) {
        super(props);
        _getDictioaries().then((data) => {
            this._allItems = data;
        });
        const columns: IColumn[] = [
            {
                key: 'column2',
                name: '关键词',
                fieldName: 'ask',
                minWidth: 210,
                maxWidth: 350,
                isRowHeader: true,
                isResizable: true,
                isSorted: true,
                isSortedDescending: false,
                sortAscendingAriaLabel: 'Sorted A to Z',
                sortDescendingAriaLabel: 'Sorted Z to A',
                onColumnClick: this._onColumnClick,
                data: 'string',
                isPadded: true,
            },
            {
                key: 'column3',
                name: '应答',
                fieldName: 'dateModifiedValue',
                minWidth: 70,
                maxWidth: 90,
                isResizable: true,
                onColumnClick: this._onColumnClick,
                data: 'string',
                onRender: (item: IDictioary) => {
                    return <span>{item.ans}</span>;
                },
                isPadded: true,
            },
        ];


        this.state = {
            items: this._allItems,
            columns: columns,
        };
    }

    public render() {
        const {columns, items} = this.state;

        return (
            <Fabric>
                <DetailsList
                    items={items}
                    columns={columns}
                    getKey={this._getKey}
                    setKey="none"
                    layoutMode={DetailsListLayoutMode.justified}
                    isHeaderVisible={true}
                    onItemInvoked={this._onItemInvoked}
                />
            </Fabric>
        );
    }

    private _getKey(item: any, index?: number): string {
        return item.key;
    }

    private _onChangeText = (ev: React.FormEvent<HTMLInputElement | HTMLTextAreaElement>, text: string): void => {
        this.setState({
            items: text ? this._allItems.filter(i => i.ask.toLowerCase().indexOf(text) > -1) : this._allItems,
        });
    };

    private _onItemInvoked(item: any): void {
        alert(`Item invoked: ${item.name}`);
    }


    private _onColumnClick = (ev: React.MouseEvent<HTMLElement>, column: IColumn): void => {
        const {columns, items} = this.state;
        const newColumns: IColumn[] = columns.slice();
        const currColumn: IColumn = newColumns.filter(currCol => column.key === currCol.key)[0];
        newColumns.forEach((newCol: IColumn) => {
            if (newCol === currColumn) {
                currColumn.isSortedDescending = !currColumn.isSortedDescending;
                currColumn.isSorted = true;
            } else {
                newCol.isSorted = false;
                newCol.isSortedDescending = true;
            }
        });
        const newItems = _copyAndSort(items, currColumn.fieldName!, currColumn.isSortedDescending);
        this.setState({
            columns: newColumns,
            items: newItems,
        });
    };
}

function _copyAndSort<T>(items: T[], columnKey: string, isSortedDescending?: boolean): T[] {
    const key = columnKey as keyof T;
    return items.slice(0).sort((a: T, b: T) => ((isSortedDescending ? a[key] < b[key] : a[key] > b[key]) ? 1 : -1));
}

async function _getDictioaries(): Promise<IDictioary[]> {
    let items: IDictioary[] = [];
    items = (await FetchAPI(apiMap.getDictionary)).data as IDictioary[];
    return items;
}
