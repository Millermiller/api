
export default interface IFeedbackForm{
  subject: string,
  message: string
}

export class FeedbackForm implements IFeedbackForm {
  message: string = ''

  subject: string = ''
}
