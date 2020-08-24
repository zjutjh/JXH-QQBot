import * as React from 'react';
import {Fabric} from 'office-ui-fabric-react/lib/Fabric';
import {DetailsList, DetailsListLayoutMode, IColumn} from 'office-ui-fabric-react/lib/DetailsList';
import {DefaultButton, PrimaryButton, Stack, IStackTokens} from 'office-ui-fabric-react';
import {mergeStyleSets} from 'office-ui-fabric-react/lib/Styling';
import {IDictioary} from "../interface/IDictionary";
import {apiMap, FetchAPI} from "../utils/Api";
import {IBan} from "../interface/IBan";

const classNames = mergeStyleSets({
    root: {
        width: "100%",
        maxWidth:"800px",
        minWidth: "400px"
    },
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

export interface IDetailsListDocumentsExampleState {
    columns: IColumn[];
    items: IBan[];
}


export class BanDictionaryList extends React.Component<{}, IDetailsListDocumentsExampleState> {
    private _allItems: IBan[] = [];
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
    public columns: IColumn[] = [
        {
            key: 'column2',
            name: 'QQ',
            fieldName: 'user_id',
            minWidth: 75,
            maxWidth:100,
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
            name: '拦截次数',
            fieldName: 'reject_times',
            minWidth: 40,
            maxWidth: 50,
            isResizable: true,
            onColumnClick: this._onColumnClick,
            data: 'string',
            onRender: (item: IBan) => {
                return <div style={{
                    whiteSpace: "pre-wrap"
                }}>
                    {item.reject_times}</div>;
            },
            isPadded: true,
        },
        {
            key: 'column3',
            name: '备注',
            fieldName: 'comments',
            minWidth: 50,
            maxWidth: 100,
            isResizable: true,
            onColumnClick: this._onColumnClick,
            data: 'string',
            onRender: (item: IBan) => {
                return <div style={{
                    whiteSpace: "pre-wrap"
                }}>
                    {item.comments}</div>;
            },
            isPadded: true,
        },
        {
            key: 'column4',
            name: '操作',
            fieldName: 'action',
            minWidth: 70,
            maxWidth: 90,
            isResizable: true,
            onColumnClick: this._onColumnClick,
            data: 'string',
            onRender: (item: IDictioary) => {
                return <span> <PrimaryButton>Modify</PrimaryButton>  <PrimaryButton>Delete</PrimaryButton> </span>;
            },
            isPadded: true,
        },
    ];

    constructor(props: {}) {
        super(props);
        this._getDictioaries().then();
        this.state = {
            items: this._allItems,
            columns: this.columns,
        };
    }

    public render() {
        const {columns, items} = this.state;
        return (
            <Fabric>
                <DetailsList
                    items={this.state.items}
                    columns={this.state.columns}
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
            items: text ? this._allItems.filter(i => i.user_id.toLowerCase().indexOf(text) > -1) : this._allItems,
        });
    };

    private _onItemInvoked(item: any): void {
        alert(`Item invoked: ${item.name}`);
    }

    async _getDictioaries(): Promise<void> {
        let items: IBan[] = [];
        this._allItems = (await FetchAPI(apiMap.getBan, {"pass": "123456"})).data as IBan[];
        console.log(this._allItems)
        this.setState({
            items: this._allItems,
            columns: this.columns,
        });
    }

}

function _copyAndSort<T>(items: T[], columnKey: string, isSortedDescending?: boolean): T[] {
    const key = columnKey as keyof T;
    return items.slice(0).sort((a: T, b: T) => ((isSortedDescending ? a[key] < b[key] : a[key] > b[key]) ? 1 : -1));
}


