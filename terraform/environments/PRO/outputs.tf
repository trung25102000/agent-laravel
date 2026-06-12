output "aws_account_id" {
  description = "AWS account ID for the active credentials."
  value       = data.aws_caller_identity.current.account_id
}

output "aws_caller_arn" {
  description = "ARN for the active IAM user or role."
  value       = data.aws_caller_identity.current.arn
}

output "aws_region" {
  description = "Resolved AWS region for the provider."
  value       = data.aws_region.current.name
}

output "s3_bucket_name" {
  description = "Created S3 bucket name."
  value       = module.s3.bucket_name
}

output "s3_bucket_arn" {
  description = "Created S3 bucket ARN."
  value       = module.s3.bucket_arn
}

output "codepipeline_name" {
  description = "Created CodePipeline name when enabled."
  value       = var.enable_codepipeline ? module.codepipeline[0].pipeline_name : null
}

output "codepipeline_arn" {
  description = "Created CodePipeline ARN when enabled."
  value       = var.enable_codepipeline ? module.codepipeline[0].pipeline_arn : null
}
