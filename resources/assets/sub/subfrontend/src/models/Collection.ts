
interface ICollection {
  data: any[]
  remove(value: any): any
  shuffle(): void
}

export class Collection implements ICollection {
   data: any[];

   constructor(data: any[]) {
     this.data = data;
   }

   public get(id: number): string {
     return this.data[id]
   }

   public remove(value: string): any {
     const idx = this.data.indexOf(value);
     if (idx !== -1) {
       return this.data.splice(idx, 1);
     }
     return false;
   }

   public add(data: any): void {
     this.data.push(data)
   }

   public count(): number {
     return this.data.length
   }

   public shuffle(): void {
     let i = this.data.length; let j; let
       tmp;
     if (i === 0) {
     // return true;
     }
     while (--i) {
       j = Math.floor(Math.random() * (i + 1));
       tmp = this.data[i];
       this.data[i] = this.data[j];
       this.data[j] = tmp;
     }
   }
}
